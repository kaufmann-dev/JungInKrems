<script>
    export let text;
    export let link;
    import { inertia } from '@inertiajs/svelte';
</script>

{#if link}
<button use:inertia="{{ href: link, method: 'get' }}" type="button" class="tw-text-white tw-bg-gray-400 hover:tw-bg-gray-500 focus:tw-outline-none  tw-font-medium tw-rounded-full tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">{#if text}{text}{:else}<slot />{/if}</button>
{:else}
<button type="button" class="tw-text-white tw-bg-gray-400 hover:tw-bg-gray-500 focus:tw-outline-none  tw-font-medium tw-rounded-full tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">{#if text}{text}{:else}<slot />{/if}</button>
{/if}
