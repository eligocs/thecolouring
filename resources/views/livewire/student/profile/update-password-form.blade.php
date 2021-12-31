<div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="updatePassword">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="current_password" value="{{ __('Current Password') }}" />
            <div class="form-group">
                <x-jet-input id="current_password" type="password" class="block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
                <i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i>
            </div>
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('New Password') }}" />
            <div class="form-group">
                <x-jet-input id="password" type="password" class="block w-full" wire:model.defer="state.password" autocomplete="new-password" />
                <i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i>
            </div>
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <div class="form-group">
                <x-jet-input id="password_confirmation" type="password" class="block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <i class="fa fa-eye-slash viewPassword" aria-hidden="true"></i>
            </div>
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
                    </div>
					<x-jet-action-message class="mr-3 text-success" on="saved">
            Password Updated Successfully
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
                </div>
				
            </div>
        </form>
    </div>				
					
</div>
