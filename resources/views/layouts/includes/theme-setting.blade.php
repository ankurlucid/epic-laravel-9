<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3">
            <div class="float-start">
                <h5 class="mt-3 mb-0">{{app_name()}} UI Configurator</h5>
                <p>See our dashboard options.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="material-icons">clear</i>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" style="display: none;" id="white-version" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
    </div>
</div>
