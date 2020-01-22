import { combineReducers } from "redux";
import { ISeason } from "../interfaces/CominovelProps";
import { appState, IAppState } from "./appReducer";
import { cominovelInfo, ICominovelState } from "./cominovelReducer";
import TaxonomyTerm from "./cominovelTaxonomy";
import { seasons } from "./seasonReducer";

export interface IRootState {
    app: IAppState;
    cominovel: ICominovelState;
    seasons: ISeason[];
    terms: any;
}

const reducers = combineReducers({
    app: appState,
    cominovel: cominovelInfo,
    seasons,
    terms: TaxonomyTerm,
});

export default reducers;
