@extends('layouts.app')

@section('custom-css')
    <style>
        /* General styling for the form and layout */
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin: 20px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        label {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            display: inline-block;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

    
        #fb-editor {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            min-height: 200px;
            background-color: #fafafa;
            box-sizing: border-box;
        }


        .card-body > * {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('custom-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

<script>
    var fbEditor = document.getElementById('fb-editor');
    var formBuilder = $(fbEditor).formBuilder({
        onSave: function(evt, formData) {
            saveForm(formData);
        },
    });

    $(function() {
        $.ajax({
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            url: '{{ URL('get-form-builder-edit') }}',
            data: {
                'id': '{{ $id }}'
            },
            success: function(data) {
                $("#name").val(data.name);
                formBuilder.actions.setData(data.content);
            }
        });
    });

    function saveForm(form) {
    $.ajax({
        type: 'post',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        url: '{{ URL('update-form-builder') }}',
        data: {
            'form': form,
            'name': $("#name").val(),
            'id': {{ $id }},
            "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
            location.href = "/";
        },
        error: function(xhr) {

            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;


                if (errors.name) {
                    alert('Name Error: ' + errors.name.join(', '));
                }
                if (errors.form) {
                    alert('Form Content Error: ' + errors.form.join(', '));
                }
            } else {

                alert('An error occurred while saving the form. Please try again.');
            }
        }
    });
}

</script>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" />
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
            <div id="fb-editor"></div>
        </div>
    </div>
@endsection
