import { combineReducers } from "redux";

import { IAppState } from "../reducers/App";
import { cominovelInfo, ICominovelState } from "../reducers/cominovelReducer";
import { appState } from "./App";

export interface IRootState {
    app: IAppState;
    cominovel: ICominovelState;
}

const reducers = combineReducers({
    app: appState,
    cominovel: cominovelInfo,
});

export default reducers;
