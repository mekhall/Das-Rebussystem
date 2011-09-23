function handleResponse(response)
{
    if (response == 'OK') {
	window.location = 'private.php';
    }
    else {
	$('login_response').set('html', response);
    }
}

window.addEvent('domready', function() {
    $('login').addEvent('submit', function(e) {
	e.stop();
	this.set('send', { onComplete: handleResponse });
	this.send();
    });
});
