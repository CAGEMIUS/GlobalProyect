<style>
    .mainContainer{
        margin-top: 150px;
    }
</style>
<x-app-layout>
    
    <div class="mainContainer py-12 text-center">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="row">
                    <div class="col">
                        <div class="p-4">
                            <div class="bg-white border border-4 border-danger shadow rounded-lg">
                                <div class="mb-4">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="p-4">
                            <div class="bg-white border border-4 border-danger shadow rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="p-4">
                            <div class="bg-white border border-4 border-danger shadow rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
