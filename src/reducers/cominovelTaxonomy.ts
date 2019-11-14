import { FETCH_TAXONOMY_TERMS_FULLFILLED } from "../actions/types";
import { ITaxonomyAction } from "../interfaces/CominovelProps";

const TaxonomyTerm = (state: any = {}, action: ITaxonomyAction) => {
    if (action.type === FETCH_TAXONOMY_TERMS_FULLFILLED) {
        return {
            ...state,
            [action.taxonomy]: action.payload,
        };
    }
    return state;
};

export default TaxonomyTerm;
