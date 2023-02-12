<script>
    export let color = 'gray';
    export let mb = 'true';
</script>

<style>
</style>

<div class="{color === 'green' ? 'tw-bg-green-400' : color === 'gray' ? 'tw-bg-slate-300' : color === 'blue' ? 'tw-bg-blue-400' : color === 'light' ? 'tw-bg-slate-200' : ''} {mb === 'true' ? 'tw-mb-1.5' : ''} tw-rounded-full tw-py-0.5 tw-px-3 tw-inline-block">
    <slot/>
</div>