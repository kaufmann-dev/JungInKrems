<script>
    import Layout from "../Shared/Layout.svelte";
    import { Link } from '@inertiajs/svelte';
    import FacilityListItem from "../Shared/FacilityListItem.svelte";

    export let facilities = [];
</script>

<Layout>
    <h1 class="tw-text-5xl tw-mb-6">Bildungsanstalten</h1>
    { #each facilities as facilitiy }
        <FacilityListItem facility={facilitiy}/>
    { /each }
</Layout>