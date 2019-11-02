import { combineReducers } from "redux";

import { IAppState } from "../reducers/App";
import { cominovelInfo, ICominovelState } from "../reducers/cominovelReducer";
import { appState } from "./App";

export interface IRootState {
    isLoaded: IAppState;
    info: ICominovelState;
}

const reducers = combineReducers({
    isLoaded: appState,
    info: cominovelInfo,
});

export default reducers;
