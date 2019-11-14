import {
    FETCH_COMINOVEL,
    FETCH_COMINOVEL_FULLFILLED,
    FETCH_TAXONOMY_TERMS,
    FETCH_TAXONOMY_TERMS_FULLFILLED,
} from "./types";

export function fetchCominovel(id: number) {
    return {
        payload: id,
        type: FETCH_COMINOVEL,
    };
}

export function fetchCominovelData(payload: any) {
    return {
        payload,
        type: FETCH_COMINOVEL_FULLFILLED,
    };
}

export function fetchTaxonomyTerms(
    taxonomy: string = "genre",
    keyword: string | null = null,
    treeView: boolean = false,
) {
    return {
        keyword,
        taxonomy,
        treeView,
        type: FETCH_TAXONOMY_TERMS,
    };
}

export function fetchTaxonomyTermsFullFilled(payload: any, taxonomy: string = "genre", keyword: string = "") {
    return {
        keyword,
        payload,
        taxonomy,
        type: FETCH_TAXONOMY_TERMS_FULLFILLED,
    };
}
