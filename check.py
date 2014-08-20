#!/usr/bin/python

import sys
import re
from itertools import product

def print_status(desc, before, after, ok):
    print "{}: {} -> {} {}".format(desc,
                                   before.encode('utf-8'),
                                   after.encode('utf-8'), "*NOT OK*" if not ok else "")


def check_back(before, after):
    ok = after == before[::-1]
    print_status('<->', before, after, ok)


def check_remove_i(before, after):
    p1 = ''
    p2 = ''
    last = 1
    ok = False
    while not ok:
        i = before.find('I', last)
        if i == -1:
            break
        last = i + 1
        p1 = before[:i]
        p2 = before[i + 1:]
        for l in range(1, len(p2)):
            p2a = p2[:l]
            p2b = p2[l:]
            test = p2a + p1 + p2b
            if test == after:
                ok = True
                break
    return ok

def check_i(before, after):
    ok = False
    if len(before) > len(after):
        ok = check_remove_i(before, after)
    else:
        ok = check_remove_i(after, before)
    print_status('  i', before, after, ok)


def check_remove_om(before, after):
    p1 = ''
    p2 = ''
    last = 2
    ok = False
    while not ok:
        i = before.find('OM', last)
        if i == -1:
            break
        last = i + 1
        p1 = before[:i]
        p2 = before[i + 2:]
        for l in range(1, len(p1)):
            p1a = p1[:l]
            p1b = p1[l:]
            test = p1a + p2 + p1b
            if test == after:
                ok = True
                break
    return ok


def check_om(before, after):
    ok = False
    if len(before) > len(after):
        ok = check_remove_om(before, after)
    else:
        ok = check_remove_om(after, before)
    print_status(' om', before, after, ok)


def replace_all(string, letter, rep):
    res = []
    s = list(string)
    for l in range(0, len(s)):
        if s[l] == letter:
            s1 = s[:]
            s1[l] = rep
            res.append(''.join(s1))
    return res


def check_comma(before, op, after, adds, subs, replaces):
    ops = re.split('\s*,\s*', op)
    add = []
    sub = []
    replace = {}
    for o in ops:
        o = o.upper()
        str = ""
        if o[0] == '+':
            add.append(o[1])
        elif o[0] == '-':
            sub.append(o[1])
        else:
            replace[o[0]] = o[3]

    _after = [after]
    _before = [before]
    for s in sub:
        b1 = []
        for b in _before:
            b1.extend(replace_all(b, s, ''))
        _before = b1
    for a in add:
        a1 = []
        for af in _after:
            a1.extend(replace_all(af, a, ''))
        _after = a1
    for r in replace.keys():
        b1 = []
        for b in _before:
            b1.extend(replace_all(b, r, replace[r]))
        _before = b1
    ok = False
    for a, b in product(_after, _before):
        if a == b:
            ok = True
    print_status(' +-', before, after, ok)
    adds.extend(add)
    subs.extend(sub)
    replaces.update(replace)


def main():
    lines = []
    with open(sys.argv[1]) as f:
        for line in f:
            l = line.decode('utf-8')
            l = l.replace('\\rebus', '')
            l = l.replace('\\ort', '')
            l = re.sub(r'\\av .*', '', l)
            l = l.strip()
            lines.append(l)

    back = 0
    adds = []
    subs = []
    replaces = {}
    for i in range(0, len(lines)):
        if lines[i].startswith('\op'):
            op = lines[i]
            op = op.replace('\op', '')
            op = re.sub(r'\(.*\)', '', op)
            op = op.strip()
            before = lines[i - 1]
            after = lines[i + 1]
            if op == "<->":
                check_back(before, after)
                back += 1
            elif op == "!":
                print "  !: {} -> {}".format(before.encode('utf-8'),
                                             after.encode('utf-8'))
            elif op == "i":
                check_i(before, after)
            elif op == "om":
                check_om(before, after)
            else:
                check_comma(before, op, after, adds, subs, replaces)
    if back != 0 and back != 2:
        print "<->: *NOT OK*"
    if adds != subs:
        print "+-: *NOT OK*"
    for k in replaces.keys():
        if replaces[k] not in replaces or replaces[replaces[k]] != k:
            print "->: *NOT OK*"


if __name__ == "__main__":
    main()
