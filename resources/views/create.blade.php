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

        /* Styling the form builder container */
        #fb-editor {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            min-height: 200px;
            background-color: #fafafa;
            box-sizing: border-box;
        }

        /* Add some spacing between the card body elements */
        .card-body > * {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script>
        jQuery(function($) {
            $(document.getElementById('fb-editor')).formBuilder({
                onSave: function(evt, formData) {
                    console.log(formData);
                    saveForm(formData)
                },
            });
        });
    </script>
    <script>
        function saveForm(form) {
            $.ajax({
                type : 'POST',
                headers : {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
                url: "{{ route('store.form') }}",
                data: {
                    'form': form,
                    'name': $("#name").val(),
                    "_token": "{{ csrf_token() }}",
                },
                success: function($data) {
                    if ($data.success) {
                        location.href = "/";
                    } else {
                        alert($data.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).after('<div class="error text-danger">' + value[0] + '</div>');
                        });
                    } else {
                        alert("There was an error saving the form.");
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
            <input type="text" id="name" name="name" class="form-controller" />
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
            <div id="fb-editor"></div>
        </div>
    </div>
@endsection


