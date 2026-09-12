<script>
    /**
     * @typedef {Object} Props
     * @property {boolean} [underline]
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let { underline = false, children } = $props();
</script>

<span class="tw:text-3xl tw:font-medium  tw:text-left tw:inline-block {underline == true ? 'tw:w-full tw:border-black tw:border-b tw:mt-7 tw:pb-1.5' : 'tw:mb-7 tw:mt-3'}">
    {@render children?.()}
</span>