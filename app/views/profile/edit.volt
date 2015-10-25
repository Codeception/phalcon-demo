<h1 class="page-header" id="forms">
    Your Profile
</h1>

{{ content() }}

<div class="profile">
    {{ form('invoices/profile', 'id': 'profileForm', 'onbeforesubmit': 'return false', 'class': 'form-horizontal') }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Your Full Name:</label>
            <div class="col-sm-10">
                {{ text_field("name", "size": "30", "class": "form-control") }}
                <span id="helpBlock2" class="help-block"><strong>Warning!</strong> Please enter your full name</span>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email Address:</label>
            <div class="col-sm-10">
                {{ text_field("email", "size": "30", "class": "form-control") }}
                <span id="helpBlock2" class="help-block"><strong>Warning!</strong> Please enter your email</span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="button" value="Update" class="btn btn-success btn-large" onclick="Profile.validate()">
                &nbsp;
                {{ link_to('invoices/index', 'Cancel', 'class': 'btn btn-default btn-large', 'role': 'button') }}
            </div>
        </div>
    </form>
</div>
