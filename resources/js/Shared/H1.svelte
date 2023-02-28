<script>
    export let mb = true;
    export let mt = true;
    export let center = false;
</script>
<span class="{mb == true ? 'tw-mb-7' : 'tw-mb-4'} {mt == true ? 'tw-mt-3' : ''} {center == true ? 'tw-text-center' : ''} tw-text-black tw-block tw-text-4xl md:tw-text-4xl lg:tw-text-5xl tw-font-medium tw-drop-shadow-sm">
    <slot></slot>
</span>