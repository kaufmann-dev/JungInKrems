<script>
    export let query = "";
</script>

<div class="tw-flex tw-border tw-items-center tw-w-full tw-max-w-md tw-mx-auto tw-bg-gray-50 tw-rounded-lg tw-shadow-sm tw-py-2 tw-px-4 tw-space-x-3">
    <span class="tw-text-gray-500">
        <i class="bi bi-search"></i>
    </span>
    <input class="tw-block tw-w-full tw-h-10 tw-rounded-lg tw-px-4 tw-font-medium tw-text-gray-700 tw-placeholder-gray-500 tw-leading-10 tw-border tw-outline-none tw-focus:tw-outline-none" type="text" placeholder="Suchen"
    bind:value={query}>
</div>