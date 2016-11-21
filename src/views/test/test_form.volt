
{% extends "layouts/main.volt" %}

{% block content %}

    <form class="form-alt" action="test/ValidateForm" data-type="ajax" method="POST">
    <div class="row type2">
      <div class="form-group">
        <label for="email">Email address:</label>
        <input type="text" name="email" class="form-control" id="email">
      </div>
      <div class"box-error"><p id="email-error" class="error"></p></div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" name="password" class="form-control" id="pwd">
      </div>
      <div class"box-rror"><p id="password-error" class="error"></p></div>
      <div class="checkbox">
        <label><input type="checkbox" name="remember"> Remember me</label>
      </div>
      <div class"box-error"><p id="remember-error" class="error"></p></div>
      <br>
      <input type="submit" class="btn" />
      </div>
    </form>
{% endblock %}