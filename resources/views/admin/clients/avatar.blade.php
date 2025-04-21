{{-- Avatar --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data"
                data-validate>
                @csrf
                @method('PUT')
                <input type="hidden" name="updateAvatar" value="1">
                <input type="hidden" name="selected_avatar" id="selected_avatar" value="">
                <div class="card-header">
                    <h5>Profile Picture</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach (range(1, 15) as $i)
                            <div class="col-md-2 mb-3">
                                <img class="rounded-circle img-fluid wid-70 avatar-image"
                                    src="{{ asset('avatars/avatar' . $i . '.jpg') }}"
                                    onclick="setAvatar('{{ asset('avatars/avatar' . $i . '.jpg') }}')">
                            </div>
                        @endforeach
                        <div class="col-md-12 mt-5">
                            <x-file-upload name="avatar"
                                help_text="{{ __('Only JPG, PNG with max 2MB file size allowed. Best image size 512px x 512px') }}" />
                        </div>
                    </div>
                    {{-- /.row --}}
                </div>
                {{-- /.card-body --}}
                <div class="card-footer text-end">
                    <x-button text="Update Profile Picture" />
                </div>
                {{-- /.card-footer --}}
            </form>
        </div>
        {{-- /.card --}}
    </div>
    {{-- /.col --}}
</div>
{{-- /.row --}}
@push('styles')
    <style>
        .selected-avatar {
            border: 3px solid #007bff;
            /* Blue border for highlighting */
            padding: 2px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function setAvatar(avatarPath) {
            var avatarInput = document.getElementById('selected_avatar');
            avatarInput.value = avatarPath;

            // Remove the highlight class from any previously selected avatar
            document.querySelectorAll('.avatar-image').forEach(function(img) {
                img.classList.remove('selected-avatar');
            });

            // Add the highlight class to the clicked avatar
            var selectedImage = document.querySelector(`img[src="${avatarPath}"]`);
            if (selectedImage) {
                selectedImage.classList.add('selected-avatar');
            }

            // Update the label text to display the selected file name
            var fileName = avatarPath.split('/').pop();
            var label = document.querySelector('#avatar');
            label.innerText = fileName;
            $('#allowUploadAvatar').show();
        }
    </script>
@endpush
