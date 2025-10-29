import globals from "globals";
import pluginJs from "@eslint/js";

export default [
    {
        languageOptions: {
            globals: {
                ...globals.browser,
            },
            ecmaVersion: 2022, 
            sourceType: "module",
        },
        ...pluginJs.configs.recommended,
    }
];