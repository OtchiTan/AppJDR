<script>
export default {
    props : ['href', 'name']
}
</script>

<template>
    <a :href="href"
        class="bg-transparent hover:bg-purple-500 text-purple-700 font-semibold hover:text-white py-2 px-4 border
             border-purple-500 hover:border-transparent rounded">
        {{ name }}
    </a>
</template>