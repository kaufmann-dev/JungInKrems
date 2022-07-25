<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import FacilityListItem from "../../Shared/FacilityListItem.svelte";
    import { page } from '@inertiajs/svelte';
    import H1 from "../../Shared/H1.svelte";
    import Subtitle from "../../Shared/Subtitle.svelte";

    export let facilities = [];
    $: myfacilities = facilities.filter(facilities => facilities.facility !== null).map(facilities => facilities.facility);
</script>

<AccLayout>
    <H1 mb={false}>Meine Bildungsanstalten</H1>
    <Subtitle>Alle Bildungsanstalten die sie verwalten dürfen. Um sichtbar zu werden muss die Stadt Krems jene zuerst noch verifizieren.</Subtitle>
    {#if !$page.props.auth.user.IS_EMAIL_VERIFIED}
        <span class="tw-mb-4 tw-block">Sie müssen Ihre E-Mail Adresse bestätigen um Bildungsanstalten verwalten zu können.</span>
        <Button link="/account/verify">Jetzt bestätigen</Button>
    {:else}
        {#if myfacilities.length === 0}
            <span class="tw-mb-4 tw-block">Sie verwalten noch keine Bildungsanstalten.</span>
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
