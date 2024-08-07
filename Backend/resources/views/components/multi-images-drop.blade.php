<script>
    // script of dropzone multipul image upload
    var uploadedPhotosMap = {}
    Dropzone.options.photosDropzone = {
        url: '{{ route('admin.guestHouses.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 2,
            width: 4096,
            height: 4096
        },
        success: function(file, response) {
            $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
            uploadedPhotosMap[file.name] = response.name
        },
        removedfile: function(file) {
            console.log(file)
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedPhotosMap[file.name]
            }
            $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
        },
        init: function() {
            @if (isset($guestHouseImages) && $guestHouseImage->photos)
                var files = {!! json_encode($guestHouseImages->photos) !!}
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">');
                }
            @endif
        },
        error: function(file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }

    }
</script>
