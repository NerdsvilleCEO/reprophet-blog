
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('bloglist', require('./components/BlogList.vue'));
Vue.component('blogpost', require('./components/BlogPost.vue'));
const app = new Vue({
    el: '#app'
});
	
$('.alert-close').click(function () {
	$(this).parent().addClass('hidden');
});

$('.jq-method-override').click(function(e) {
    e.preventDefault();
	$.ajax({
		type: $(this).data('method'),
		url: $(this)[0].href,
		data: {
			_token: window.Laravel.csrfToken
		},
		success: function(response) {
			location.href = response.redirect;	
        }, 
		error: function(response) {
			$('#flash-error-msg').text(response.responseJSON.errors);
			$('#flash-error').removeClass('hidden');
		}
	});
});

$('#blog-edit').submit(function(e) {
	e.preventDefault();
	$.ajax({
		url: '/blog/'+ $('#post_id').val(),
        type: 'PUT',
        dataType: 'json',
        data: $('form#blog-edit').serialize(), 
        success: function(response) {
			$('#flash-success-msg').text(response.success);
			$('#flash-success').removeClass('hidden');		
		},
		error: function(response) {
			location.href = response.responseJSON.redirect;
		}
	});
});

$('#new-blog').submit(function(e) {
	e.preventDefault();
	$('#content').html( tinymce.get('content').getContent() );
	$.ajax({
		url: '/blog/',
        type: 'POST',
        dataType: 'json',
        data: $('form#new-blog').serialize(), 
        success: function(response) {
			location.href = response.redirect;	
		},
		error: function(response) {
			var msg = '';
			for(error in response.responseJSON.errors) {
				msg += '<li>' + response.responseJSON.errors[error] + '</li>';
			}
			$('#flash-error-msg').html(msg);
			$('#flash-error').removeClass('hidden');
		}
	});
});
