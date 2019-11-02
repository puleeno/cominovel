import { combineReducers } from "redux";

import { IAppState } from '../reducers/App';
import { appState } from "./App";

export interface IRootState {
    isLoaded: IAppState;
}

const reducers = combineReducers({
    isLoaded: appState,
});

export default reducers;
