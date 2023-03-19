<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import FacilityListItem from "../../Shared/FacilityListItem.svelte";
    import { page } from '@inertiajs/svelte';
    import H1 from "../../Shared/H1.svelte";
    import Subtitle from "../../Shared/Subtitle.svelte";
    import InfoText from "../../Shared/InfoText.svelte";

    export let facilities = [];
    $: myfacilities = facilities.filter(facilities => facilities.facility !== null).map(facilities => facilities.facility);
</script>

<AccLayout>
    <H1 mb={false}>Meine Bildungsanstalten</H1>
    <Subtitle>Alle Bildungsanstalten die sie verwalten dürfen. Um sichtbar zu werden muss die Stadt Krems jene zuerst noch verifizieren.</Subtitle>
    {#if !$page.props.auth.user.IS_EMAIL_VERIFIED}
        <InfoText mb="true" color="light">Sie müssen Ihre E-Mail Adresse bestätigen um Bildungsanstalten verwalten zu können.</InfoText>
        <Button size="small" link="/account/verify"><div class="tw-mx-2">Jetzt bestätigen</div></Button>
    {:else}
        {#if myfacilities.length === 0}
            <InfoText mb="true" color="light">Sie verwalten noch keine Bildungsanstalten.</InfoText>
        {:else}
            <div class="tw-mb-4">
                {#each myfacilities as facility}
                    <FacilityListItem facility={facility}/>
                {/each}
            </div>
        {/if}
        <Button link="/newfacility">Neue Bildungsanstalt anmelden</Button>
    {/if}
</AccLayout>
