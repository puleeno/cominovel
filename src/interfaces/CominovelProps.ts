export interface IEndpoint {
    GetComic: string;
    GetNovel: string;
}

export interface ICominovelProps {
    currentID: BigInt;
    endpoints: IEndpoint[];
    languages: any;
    messages: any;
}

export interface ICominovelData {
    ID: BigInt | number;
    alternative_name: string;
    artist: string;
    audult: string;
    author: string;
    badge: string;
    chapters: any;
    generes: string;
    parent: BigInt | number;
    post_content: string;
    post_excerpt: string;
    post_modified: any;
    post_name: string;
    post_parent: BigInt | number;
    post_status: string;
    post_title: string;
    post_type: string;
    release: BigInt | number | string;
    seasons: string;
    short_description: string;
    status: string;
    type: string;
}
