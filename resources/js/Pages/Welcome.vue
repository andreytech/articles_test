<script setup>
  import { ref } from 'vue';

  const articlesList = ref([]);

  async function getData() {
    const res = await fetch("http://localhost/api/articles");
    articlesList.value = await res.json();
  }

 getData()
</script>

<template>

    <div class="bg-gray-100 p-8">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">
                List of Articles
            </h1>

            <div class="grid grid-cols-1 gap-6">

                <div class="bg-white p-6 rounded-lg shadow-md" v-for="article in articlesList">
                    <div class="mb-4">
                        <img
                            :src="article.image_url"
                            class="w-full h-32 object-cover object-center rounded"
                        />
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        <a :href="article.link">
                            {{article.title}}
                        </a>
                    </h2>
                    <p class="text-gray-600">
                        {{article.excerpt}}
                    </p>
                    <p class="text-sm text-gray-500">
                        Published on: {{article.date}}
                    </p>
                </div>

            </div>
        </div>
    </div>
</template>
