<div class="page-header">
    <h2>Contact Us</h2>
</div>

{{ content() }}

<p>
    Send us a message and let us know how we can help.
    Please be as descriptive as possible as it will help us serve you better.
</p>

{{ form('contact/send', 'role': 'form', "class" : "form-horizontal") }}
    <div class="form-group">
        {{ form.label('name', ['class': 'col-sm-2 control-label', 'for': 'fieldName']) }}
        <div class="col-sm-10">
            {{ form.render('name', ['class': 'form-control', 'id': 'fieldName']) }}
        </div>
    </div>
    <div class="form-group">
        {{ form.label('email', ['class': 'col-sm-2 control-label', 'for': 'fieldEmail']) }}
        <div class="col-sm-10">
            {{ form.render('email', ['class': 'form-control', 'id': 'fieldEmail']) }}
        </div>
    </div>

    <div class="form-group">
        {{ form.label('comments', ['class': 'col-sm-2 control-label', 'for': 'fieldComments']) }}
        <div class="col-sm-10">
            {{ form.render('comments', ['class': 'form-control', 'id': 'fieldComments']) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ submit_button('Send', 'class': 'btn btn-primary btn-lg') }}
        </div>
    </div>
</form>
