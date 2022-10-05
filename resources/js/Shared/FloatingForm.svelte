<script>
    import ErrorMessage from './ErrorMessage.svelte';
    import SubmitButton from './SubmitButton.svelte';
    import Input from './Input.svelte';

    export let onSubmit = () => {};
    export let name;
    export let additionalError = '';

    let handleSubmit = () => {
        onSubmit();
    }

    function typeAction(node, type) {
        node.type = type;
    }

    export let data;
</script>

<div class=" tw-bg-gray-50 tw-border tw-p-5 tw-rounded-xl">
    <h1 class="tw-mb-5 tw-pb-1.5 tw-border-b tw-border-black">{name}</h1>
    <form on:submit|preventDefault={handleSubmit}>
        {#each data as member}
            <label for={member.name} class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-2">{member.name}</label>
            <div class="tw-mb-4">
                {#if member.type != 'checkbox'}
                    <Input data={member} />
                {:else}
                    <input type="checkbox" name={member.name} id={member.name} class="tw-shadow-none tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" bind:checked={member.value}>
                {/if}
                <ErrorMessage>{member.error}</ErrorMessage>
            </div>
        {/each}
        <div class="tw-mt-5">
            <SubmitButton>{name}</SubmitButton>
        </div>
        <ErrorMessage>{additionalError}</ErrorMessage>
    </form>
</div>