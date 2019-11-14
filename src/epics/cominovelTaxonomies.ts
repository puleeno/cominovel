import { Action, AnyAction } from "redux";
import { Epic, ofType } from "redux-observable";
import { from } from "rxjs";
import { ajax } from "rxjs/ajax";
import { map, mergeMap } from "rxjs/operators";
import { fetchTaxonomyTermsFullFilled } from "../actions";
import { FETCH_TAXONOMY_TERMS } from "../actions/types";

export const fetchTaxonomyTerms: Epic<Action<any>, Action<any>> = (action$) => action$.pipe(
    ofType(FETCH_TAXONOMY_TERMS),
    mergeMap(
        (action: AnyAction) => {
            const taxonomy = action.taxonomy || "genre";
            return from(
                ajax.getJSON(`http://loveofboys.io/wp-json/wp/v2/${taxonomy}`),
            ).pipe(
                map((response: any) => fetchTaxonomyTermsFullFilled(response, taxonomy, action.keyword)),
            );
        },
    ),
);
