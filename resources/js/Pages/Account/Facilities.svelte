<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import EventListItem from "../../Shared/EventListItem.svelte";
    import FacilityListItem from "../../Shared/FacilityListItem.svelte";
    import { page } from '@inertiajs/svelte';
    import H1 from "../../Shared/H1.svelte";

    export let facilities = [];
    $: myfacilities = facilities.filter(facilities => facilities.facility !== null).map(facilities => facilities.facility);
</script>

<AccLayout>
    <H1 class="tw-mt-6">Meine Bildungsanstalten</H1>
    <p class="tw-text-gray-500">Alle Bildungsanstalten die sie verwalten dürfen. Um sichtbar zu werden muss die Stadt Krems jene zuerst noch verifizieren.</p>
    {#if !$page.props.auth.user.IS_EMAIL_VERIFIED}
        <hr>
        <p>Sie müssen Ihre E-Mail Adresse bestätigen um Bildungsanstalten verwalten zu können.</p>
        <Button link="/verify">Jetzt bestätigen</Button>
    {:else}
        {#if myfacilities.length === 0}
            <p>Sie verwalten noch keine Bildungsanstalten.</p>
        {:else}
            {#each myfacilities as facility}
                <FacilityListItem facility={facility}/>
            {/each}
        {/if}
        <div class="mt-3" on:click={()=>creating=true}>
            <!-- <Button link="/new">Als Verwalter anmelden</Button> -->
            <Button link="/newfacility">Neue Bildungsanstalt anmelden</Button>
        </div>
    {/if}
</AccLayout>
