<template>
    <div>
        <h1>Matching Affiliates Within 100km of Dublin Office</h1>
        <button @click="fetchAffiliates">Fetch Affiliates</button>
        <ul>
            <li v-for="affiliate in matchingAffiliates" :key="affiliate.affiliate_id">
                <strong>ID:</strong> {{ affiliate.affiliate_id }}, <strong>Name:</strong> {{ affiliate.name }}
            </li>
        </ul>
    </div>
</template>

<script>
import { useAffiliatesStore } from "../stores/affiliatesStore.js";
import { storeToRefs } from "pinia";

export default {
    setup() {
        const affiliatesStore = useAffiliatesStore();
        const { matchingAffiliates } = storeToRefs(affiliatesStore)

        const fetchAffiliates = () => {
            affiliatesStore.fetchMatchingAffiliates();
        };

        return {
            matchingAffiliates,
            fetchAffiliates,
        };
    },
};
</script>
