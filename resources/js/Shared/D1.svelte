<script>
    /**
     * @typedef {Object} Props
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let { children } = $props();
</script>

<span class="tw:text-5xl tw:font-bold tw:block">
    {@render children?.()}
</span>