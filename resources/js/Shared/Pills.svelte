<script>
    import { createEventDispatcher } from 'svelte';
    import { onMount } from 'svelte';
    export let pills = [];
    export let activePill = pills[0];
    const dispatch = createEventDispatcher();

    onMount(() => {
        dispatch('pillsUpdate', activePill);
    });
    
    function handleUpdate(pill) {
        activePill = pill;
        dispatch('pillsUpdate', activePill);
    }
</script>

<style>
    .active {
        background-color: #4a5568;
        color: white;
    }
</style>

<nav class="tw-flex tw-justify-center tw-my-5">
    {#each pills as pill}
        <button class:active="{activePill == pill}" on:click={()=>handleUpdate(pill)} class="tw-px-4 tw-py-2 tw-mr-6 tw-text-lg tw-font-medium tw-bg-gray-300 tw-rounded-full tw-text-gray-700 tw-leading-none hover:tw-bg-gray-400">{pill}</button>
    {/each}
</nav>