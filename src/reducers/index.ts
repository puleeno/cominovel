import { combineReducers } from "redux";

import { appState } from "./App";

const reducers = combineReducers({
    isLoaded: true,
});

export type AppState = ReturnType<typeof reducers>;
export default reducers;
