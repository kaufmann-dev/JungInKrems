<script>
    import Layout from "../Shared/Layout.svelte";
    import FacilityListItem from "../Shared/FacilityListItem.svelte";
    import H1 from "../Shared/H1.svelte";

    export let facilities = [];
</script>

<Layout>
    <H1>Bildungsanstalten</H1>
    { #each facilities as facilitiy }
        <FacilityListItem facility={facilitiy}/>
    { /each }
</Layout>