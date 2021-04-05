<template>
    <v-expansion-panels v-model="panel" flat class="block-border">
        <v-expansion-panel>
            <v-expansion-panel-content class="pt-4">
                <slot></slot>
            </v-expansion-panel-content>
            <v-expansion-panel-header class="panel-header">
                <template v-slot:actions>
                    <v-icon color="#ffffff">
                        $expand
                    </v-icon>
                </template>
            </v-expansion-panel-header>

        </v-expansion-panel>
    </v-expansion-panels>
</template>

<script>
    export default {
        name: "AppSearchPanel",
        data() {
            return {
                panel: 0,
            }
        }
    }
</script>

<style scoped>
    .panel-header{
        background-color:#363636;
        border-color:#363636;
        min-height:20px;
        height: 30px;
        width: auto;
        position: absolute;
        right: 0;
        bottom: 0;
        border-radius: 0;
    }
</style>