"use strict";
var KTBootstrapMaxlength = {
    init: function () {
        $("#kt_maxlength_1").maxlength({
            warningClass: "kt-badge kt-badge--warning kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--success kt-badge--rounded kt-badge--inline"
        }), $("#kt_maxlength_2").maxlength({
            threshold: 5,
            warningClass: "kt-badge kt-badge--danger kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--success kt-badge--rounded kt-badge--inline"
        }), $("#kt_maxlength_3").maxlength({
            alwaysShow: !0,
            threshold: 5,
            warningClass: "kt-badge kt-badge--primary kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline"
        }), $("#kt_maxlength_4").maxlength({
            threshold: 3,
            warningClass: "kt-badge kt-badge--danger kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--success kt-badge--rounded kt-badge--inline",
            separator: " of ",
            preText: "You have ",
            postText: " chars remaining.",
            validate: !0
        }), $("#kt_maxlength_5").maxlength({
            threshold: 5,
            warningClass: "kt-badge kt-badge--primary kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline"
        }), $("#kt_maxlength_6_1").maxlength({
            alwaysShow: !0,
            threshold: 5,
            placement: "top-left",
            warningClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline"
        }), $("#kt_maxlength_6_2").maxlength({
            alwaysShow: !0,
            threshold: 5,
            placement: "top-right",
            warningClass: "kt-badge kt-badge--success kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline"
        }), $("#kt_maxlength_6_3").maxlength({
            alwaysShow: !0,
            threshold: 5,
            placement: "bottom-left",
            warningClass: "kt-badge kt-badge--warning kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline"
        }), $("#kt_maxlength_6_4").maxlength({
            alwaysShow: !0,
            threshold: 5,
            placement: "bottom-right",
            warningClass: "kt-badge kt-badge--danger kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline"
        }), $("#kt_maxlength_1_modal").maxlength({
            warningClass: "kt-badge kt-badge--warning kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--success kt-badge--rounded kt-badge--inline",
            appendToParent: !0
        }), $("#kt_maxlength_2_modal").maxlength({
            threshold: 5,
            warningClass: "kt-badge kt-badge--danger kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--success kt-badge--rounded kt-badge--inline",
            appendToParent: !0
        }), $("#kt_maxlength_5_modal").maxlength({
            threshold: 5,
            warningClass: "kt-badge kt-badge--primary kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--brand kt-badge--rounded kt-badge--inline",
            appendToParent: !0
        }), $("#kt_maxlength_4_modal").maxlength({
            threshold: 3,
            warningClass: "kt-badge kt-badge--danger kt-badge--rounded kt-badge--inline",
            limitReachedClass: "kt-badge kt-badge--success kt-badge--rounded kt-badge--inline",
            appendToParent: !0,
            separator: " of ",
            preText: "You have ",
            postText: " chars remaining.",
            validate: !0
        })
    }
};
jQuery(document).ready(function () {
    KTBootstrapMaxlength.init()
});
