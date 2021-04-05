import App from '@/App.vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import {shallowMount, createLocalVue} from '@vue/test-utils'
import Vuetify from "vuetify";

import { __createMocks as createStoreMocks } from '@/store/modules/auth/__mock__/auth';

describe('App.vue', () => {
    let storeMocks = null;
    let localVue = null;
    let wrapper = null;
    let vuetify = null;
    let router = null;

    beforeEach(() => {

        localVue = createLocalVue();
        localVue.use(VueRouter);
        localVue.use(Vuex);
        storeMocks = createStoreMocks();

        router = new VueRouter()
        vuetify = new Vuetify()

        wrapper = shallowMount(App, {
            store: storeMocks.store,
            localVue,
            router,
            vuetify
        })
    })

    test('snapshot', () => {
        expect(wrapper).toMatchSnapshot()
    })

    test('can find AppNotify component', () => {
        const component = wrapper.findComponent({name: 'AppNotify'})
        expect(component.exists()).toBe(true)
    })

    test('can find AppSideBar component', () => {
        const component = wrapper.findComponent({name: 'AppSideBar'})
        expect(component.exists()).toBe(true)
    })

    test('can find AppToolBar component', () => {
        const component = wrapper.findComponent({name: 'AppToolBar'})
        expect(component.exists()).toBe(true)
    })

    test('can find AppToTop component', () => {
        const component = wrapper.findComponent({name: 'AppToTop'})
        expect(component.exists()).toBe(true)
    })

})


