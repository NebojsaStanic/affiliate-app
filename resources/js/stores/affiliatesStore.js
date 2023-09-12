import { defineStore } from 'pinia';
const appUrl = import.meta.env.VITE_APP_URL;

export const useAffiliatesStore = defineStore('affiliates', {
    state: () => ({
        matchingAffiliates: [],
    }),
    actions: {
        async fetchMatchingAffiliates() {
            try {
                const response = await fetch(`${appUrl}/api/get-nearby-affiliates`);
                this.matchingAffiliates = await response.json();
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },
    }
});
