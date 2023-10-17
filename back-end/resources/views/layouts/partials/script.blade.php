<script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) , {
            ckfinder:{
                uploadUrl :'{{ route('checkEditor.upload').'?_token='.csrf_token() }}'
            }
        })
        .catch( error => {
        console.log( error );
    } );
</script>

