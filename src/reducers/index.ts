import { combineReducers } from "redux";

import { appState, IAppState } from "./appReducer";
import { cominovelInfo, ICominovelState } from "./cominovelReducer";
import TaxonomyTerm from "./cominovelTaxonomy";
import { ISeasonState, seasons } from "./seasonReducer";

export interface IRootState {
    app: IAppState;
    cominovel: ICominovelState;
    seasons: ISeasonState;
    terms: any;
}

const reducers = combineReducers({
    app: appState,
    cominovel: cominovelInfo,
    seasons,
    terms: TaxonomyTerm,
});

export default reducers;
