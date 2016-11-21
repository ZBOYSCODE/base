{% extends "layouts/login.volt" %}

{% block content %}


	<h1>Upload Avatar</h1>


	


	{{ form('assets/uploadAvatar', 'method': 'post', 'enctype': 'multipart/form-data') }}

	 
	    <label>Avatar</label>

	    {{ file_field("avatar", "size": 32) }}
	 
	    {{ submit_button('Send') }}
	    
	</form>


{% endblock %}
