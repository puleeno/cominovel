import { combineReducers } from "redux";

import { appState, IAppState } from "./appReducer";
import { cominovelInfo, ICominovelState } from "./cominovelReducer";
import { ISeasonState, seasons } from "./seasonReducer";

export interface IRootState {
    app: IAppState;
    cominovel: ICominovelState;
    seasons: ISeasonState;
}

const reducers = combineReducers({
    app: appState,
    cominovel: cominovelInfo,
    seasons,
});

export default reducers;
