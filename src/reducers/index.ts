import { combineReducers } from "redux";

import { IAppState } from "../reducers/App";
import { cominovelInfo, ICominovelState } from "../reducers/cominovelReducer";
import { appState } from "./App";

export interface IRootState {
    isLoaded: IAppState;
    cominovel: ICominovelState;
}

const reducers = combineReducers({
    cominovel: cominovelInfo,
    isLoaded: appState,
});

export default reducers;
