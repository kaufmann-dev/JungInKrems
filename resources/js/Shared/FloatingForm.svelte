<script>
    import ErrorMessage from './ErrorMessage.svelte';
    export let onSubmit = () => {};
    export let name;
    export let additionalError = '';
    import SubmitButton from './SubmitButton.svelte';
    import Input from './Input.svelte';

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
        <!-- <div class="tw-mb-3">
            <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">E-Mail</label>
            <input type="email" name="email" id="email" class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" placeholder="E-Mail" bind:value={credentials.email}>
            <span class="tw-text-red-500 tw-text-sm">{errors.email}</span>
        </div>
        <div class="tw-mb-3">
            <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Passwort</label>
            <input type="password" name="password" id="password" class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" placeholder="Passwort" bind:value={credentials.password}>
            <span class="tw-text-red-500 tw-text-sm">{errors.password}</span>
        </div>
        <div class="tw-mb-3">
            <label for="remember" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Sitzung speichern</label>
            <input type="checkbox" name="remember" id="remember" class="tw-shadow-none tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" bind:checked={credentials.remember}>
            <span class="tw-text-red-500 tw-text-sm">{errors.remember}</span>
        </div> -->
        <div class="tw-mt-5">
            <SubmitButton>{name}</SubmitButton>
        </div>
        <ErrorMessage>{additionalError}</ErrorMessage>
    </form>
</div>