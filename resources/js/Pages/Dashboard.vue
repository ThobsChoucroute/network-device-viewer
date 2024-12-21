<script setup>
import Layout from "@/Layouts/Layout.vue";
import { usePoll } from "@inertiajs/vue3";

const { start, stop } = usePoll(
    5000,
    {
        only: ["devices"],
        onStart() {
            console.log("Retrieving devices...");
        },
        onFinish() {
            console.log("Devices retrieved !");
        },
    },
    {
        keepAlive: true,
    }
);
</script>

<template>
    <Layout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="relative overflow-x-auto">
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Appareil
                                    </th>
                                    <th scope="col" class="px-6 py-3">IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    v-for="device in $page.props.devices"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ device.name }}
                                    </th>
                                    <td class="px-6 py-4">{{ device.ip }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
