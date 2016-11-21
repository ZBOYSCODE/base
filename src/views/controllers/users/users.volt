{% extends "layout.volt" %}


{% block content %}


	<h1>Users</h1>

	{{ partial("partials/msg") }}

	<ul>
		{% for user in users %}
	  		<li>{{ user.name }}</li>
		{% endfor %}
	</ul>



	{{ form('admin/users', 'method': 'post') }}

	    <label>Name</label>
	    {{ text_field("name", "size": 32) }}
	 
	    <label>Type</label>
	    {{ select("type", users, 'using': ['id', 'name']) }}
	 
	    {{ submit_button('Send') }}
	    
	</form>


{% endblock %}
