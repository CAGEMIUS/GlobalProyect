<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-danger" id="open-delete-modal">{{ __('Delete Account') }}</button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirm-user-deletion-label">{{ __('Are you sure you want to delete your account?') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">
                            @error('userDeletion.password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancel-btn">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
   
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('open-delete-modal').addEventListener('click', function() {
            var myModal = new bootstrap.Modal(document.getElementById('confirm-user-deletion'));
            myModal.show();
        });
    });
    
</script>
