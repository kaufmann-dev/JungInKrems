<script>
    import { Link } from '@inertiajs/svelte';

    let { link, size = 'big', type = 'primary', title = '', onClick = () => {}, children } = $props();
    let colors = $derived({
        primary: 'tw:text-black tw:bg-yellow-400 tw:hover:bg-yellow-500',
        danger: 'tw:bg-red-500 tw:hover:bg-red-600 tw:text-white',
        light: 'tw:bg-gray-500 tw:hover:bg-gray-600 tw:text-white',
        success: 'tw:bg-green-400 tw:hover:bg-green-500 tw:text-white',
        warning: 'tw:bg-orange-400 tw:hover:bg-orange-500 tw:text-white'
    }[type] ?? '');
    let classes = $derived(`${colors} ${size === 'small' ? 'tw:rounded-md tw:py-1 tw:px-2 tw:font-normal' : 'tw:rounded-3xl tw:px-5 tw:py-2.5 tw:text-sm'} tw:cursor-pointer tw:font-medium tw:text-center tw:inline-block tw:no-underline tw:hover:shadow-xl tw:hover:rounded-sm tw:duration-200 tw:focus-visible:outline-2 tw:focus-visible:outline-offset-2`);
</script>

{#if link}
    <Link href={link} {title} onclick={onClick} class={classes}>
        {@render children?.()}
    </Link>
{:else}
    <button type="button" {title} aria-label={title || undefined} onclick={onClick} class={classes}>
        {@render children?.()}
    </button>
{/if}
