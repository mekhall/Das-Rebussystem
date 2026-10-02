#!/usr/bin/python3

import sys
import re
from itertools import product
from collections import defaultdict


def print_status(desc, before, after, ok):
    print("{}: {} -> {} {}".format(desc, before, after,
                                   "*NOT OK*" if not ok else ""))


def check_back(before, after):
    ok = after.lower() == before.lower()[::-1]
    print_status('<->', before, after, ok)


def check_remove_i(before, after):
    p1 = ''
    p2 = ''
    last = 1
    while True:
        i = before.find('I', last)
        if i == -1:
            return False, after
        last = i + 1
        p1 = before[:i]
        p2 = before[i + 1:]
        for li in range(1, len(p2)):
            p2a = p2[:li]
            p2b = p2[li:]
            _test = p2a + p1 + p2b
            if _test == after:
                test = p2a + ' ' + p1 + ' ' + p2b
                return True, test


def check_i(before, after):
    if len(before) > len(after):
        ok, after = check_remove_i(before, after)
    else:
        ok, before = check_remove_i(after, before)
    print_status('  i', before, after, ok)


def check_remove_om(before, after):
    p1 = ''
    p2 = ''
    last = 2
    while True:
        i = before.find('OM', last)
        if i == -1:
            return False, after
        last = i + 1
        p1 = before[:i]
        p2 = before[i + 2:]
        for li in range(1, len(p1)):
            p1a = p1[:li]
            p1b = p1[li:]
            _test = p1a + p2 + p1b
            if _test == after:
                test = p1a + ' ' + p2 + ' ' + p1b
                return True, test


def check_om(before, after):
    if len(before) > len(after):
        ok, after = check_remove_om(before, after)
    else:
        ok, before = check_remove_om(after, before)
    print_status(' om', before, after, ok)


def replace_all(string, letter, rep):
    res = []
    s = list(string.lower())
    for li in range(0, len(s)):
        if s[li] == letter:
            s1 = s[:]
            s1[li] = rep
            res.append(''.join(s1))
    return res


def replace_list(list, f, t):
    n = []
    for li in list:
        n.extend(replace_all(li, f, t))
    return n


def check_comma(before, op, after, adds, subs, replaces):
    ops = re.split(r'\s*,\s*', op)
    add = []
    sub = []
    replace = defaultdict(list)
    for o in ops:
        o = o.lower()
        if o[0] == '+':
            add.append(o[1])
        elif o[0] == '-':
            sub.append(o[1])
        elif re.match(r'\w->\w', o):
            replace[o[0]].append(o[3])
        else:
            print('  ?:', o)
            return

    _after = [after]
    _before = [before]
    for s in sub:
        _before = replace_list(_before, s, '')
    for a in add:
        _after = replace_list(_after, a, '')
    for f, t in replace.items():
        for t1 in t:
            _before = replace_list(_before, f, t1)

    ok = len([a_b for a_b in product(_after, _before)
              if a_b[0].lower() == a_b[1].lower()]) > 0
    for a in add:
        print(' +' + a + ':')
    for s in sub:
        print(' -' + s + ':')
    for a, b in replace.items():
        for b1 in b:
            print(a + '>' + b1 + ':')
    print_status('   ', before, after, ok)
    adds.extend(add)
    subs.extend(sub)
    replaces.update(replace)


def check_assoc(before, after):
    print("  !: {} -> {}".format(before, after))


def check(filename):
    lines = []
    with open(filename) as f:
        for line in f:
            li = line
            li = li.replace('\\rebus', '')
            li = li.replace('\\ort', '')
            li = re.sub(r'\\upphovsman .*', '', li)
            li = re.sub(r'\\av .*', '', li)
            li = re.sub(r'\\orgbild .*', '', li)
            li = re.sub(r'\\bild .*', '', li)
            li = li.strip()
            lines.append(li)

    back = 0
    adds = []
    subs = []
    replaces = {}
    for i in range(0, len(lines)):
        if lines[i].startswith('\\op'):
            op = lines[i]
            op = op.replace('\\op', '')
            op = re.sub(r'\(.*\)', '', op)
            op = op.strip()
            before = lines[i - 1]
            before = re.sub(r'\s+', '', before)
            after = lines[i + 1]
            after = re.sub(r'\s+', '', after)
            if op == "<->":
                check_back(before, after)
                back += 1
            elif op == "!" or op == "gruppera":
                check_assoc(before, after)
            elif op == "i" or op == "i-inskrivning" or op == "i-utbrytning":
                check_i(before, after)
            elif op == "om" or op == "om-skrivning":
                check_om(before, after)
            else:
                check_comma(before, op, after, adds, subs, replaces)
    if back != 0 and back != 2:
        print("<->: *NOT OK*")
    if adds.sort() != subs.sort():
        print("+-: *NOT OK*")
    for k in list(replaces.keys()):
        for to in replaces[k]:
            if to not in replaces or k not in replaces[to]:
                print("->: *NOT OK*")


def main():
    for arg in sys.argv[1:]:
        print(arg)
        check(arg)
        print()


if __name__ == "__main__":
    main()
