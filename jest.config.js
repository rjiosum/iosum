module.exports = {
    verbose: true,
    testRegex: 'resources/assets/js/tests/.*.spec.js$',
    moduleNameMapper: {
        "^@/(.*)$": "<rootDir>/resources/assets/js/$1"
    },
    moduleFileExtensions: ["js","json","vue"],
    transform: {
        ".*\\.(vue)$": "<rootDir>/node_modules/vue-jest",
        "^.+\\.js$": "<rootDir>/node_modules/babel-jest"
    },
    setupFiles: [
        '<rootDir>/resources/assets/js/tests/setup.js'
    ]
    /*snapshotSerializers: ['jest-serializer-vue'],
    collectCoverageFrom: [
        'resources/assets/js/!**!/!*.{js,jsx,ts,tsx,vue}',
    ],
    collectCoverage: true,
    coverageReporters: ['html', 'lcov', 'text-summary'],
    coverageDirectory: './coverage'*/
}