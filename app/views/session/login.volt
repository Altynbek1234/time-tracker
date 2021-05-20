{{ content() }}

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-4 mb-4 mt-4">
            <h1 class="mb-sm-4 pb-sm-2">Log In</h1>
            {{ assets.outputJs() }}

	    {{ form('class': 'form-signin') }}

                {{ form.label('email', ['class' : 'sr-only']) }}
		{{ form.render('email', ['class' : 'form-control ']) }}

                {{ form.label('password', ['class' : 'sr-only']) }}
		{{ form.render('password',['class' : 'form-control ']) }}

		{{ form.render('go', ['class' : 'btn btn-success btn-block']) }}

		<hr>

		<div class="forgot">
			{{ link_to("session/forgotPassword", "Forgot password ?", "class":"form-text text-muted") }}
		</div>

	    </form>
	</div>
    </div>

</div>
<script>


// {{ javascript_include( [ "src":"https://code.jquery.com/jquery-3.5.1.min.js" ] ) }}
</script>
