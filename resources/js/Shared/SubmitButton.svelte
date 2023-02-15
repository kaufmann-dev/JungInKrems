<script>
    export let text;
</script>

<style>
    button {
        min-width: 120px;
    }
</style>

<button type="submit" class="tw-text-white tw-inline-block tw-bg-yellow-400 hover:tw-bg-yellow-500 focus:tw-outline-none tw-font-medium tw-text-sm tw-text-center tw-rounded tw-py-2 tw-px-4">
{#if text}
    {text}
{:else}
    <slot />
{/if}
</button>