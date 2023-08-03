<script>
    import Layout from "../Shared/Layout.svelte";
    import FacilityListItem from "../Shared/FacilityListItem.svelte";
    import H1 from "../Shared/H1.svelte";
    import SearchBar from "../Shared/SearchBar.svelte";
    import InfoText from "../Shared/InfoText.svelte";

    let query = "";

    export let facilities = [];
    $: filteredFacilities = facilities.filter(facility =>
        facility.NAME.toLowerCase().includes(query.toLowerCase()) ||
        facility.FACILITY_TYPE.toLowerCase().includes(query.toLowerCase()) ||
        facility.WEBSITE_URL.toLowerCase().includes(query.toLowerCase()) ||
        facility.EMAIL.toLowerCase().includes(query.toLowerCase()) ||
        facility.ADDRESS.toLowerCase().includes(query.toLowerCase()) ||
        facility.POSTAL_CODE.toLowerCase().includes(query.toLowerCase()) ||
        facility.CITY.toLowerCase().includes(query.toLowerCase())
    ).sort((a, b) => a.NAME.toLowerCase().localeCompare(b.NAME.toLowerCase()));


</script>

<Layout>
    <H1 center={true}>Bildungsanstalten</H1>
    <SearchBar bind:query={query} />
    {#if filteredFacilities.length === 0}
        <div class="tw-text-center tw-mt-3">
            <InfoText color="light">Keine Bildungsanstalten verfügbar.</InfoText>
        </div>
    {:else}
        {#each filteredFacilities as facility}
            <FacilityListItem facility={facility}/>
        {/each}
    {/if}
</Layout>