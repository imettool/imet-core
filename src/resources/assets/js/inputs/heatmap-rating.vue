<!--
  - Copyright (C) 2026 European Union
  - This program is free software: you can redistribute it and/or modify it under the terms of the
  - EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
  - This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
  - warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
  - further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
  - If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
  -->

<!--
  - heatmap-rating
  - --------------
  - A 0–N rating that collapses to a single block of colour (a "heatmap cell").
  - The cell shows ONLY colour — never a number. Click it to open a vertical
  - popover of swatches (+ a clear action). The word labels come from the
  - `legend` prop (the module's ratingLegend) and appear only inside the picker.
  -->

<template>
    <div>

        <button
            ref="trigger"
            type="button"
            class="heatmap-rating-cell field-edit"
            :class="{
                'heatmap-rating-cell--empty': !isSet,
                'heatmap-rating-cell--set': isSet,
                'heatmap-rating-cell--zero': score === 0,
            }"
            :style="cellStyle"
            aria-haspopup="listbox"
            :aria-expanded="open"
            @click="toggle"
            @keydown="onTriggerKeydown"
        ></button>

        <Teleport to="body">
            <div
                v-if="open"
                ref="popover"
                class="heatmap-rating-popover"
                role="listbox"
                tabindex="-1"
                :style="popStyle"
                @keydown="onPopoverKeydown"
            >
                <div
                    v-for="(label, index) in labels"
                    :key="index"
                    class="heatmap-rating-popover__row"
                    :class="{ 'is-active': highlighted === index, 'is-selected': score === index }"
                    role="option"
                    :aria-selected="score === index"
                    @click="pick(index)"
                    @mouseenter="highlighted = index"
                >
                    <span class="heatmap-rating-popover__chip" :style="{ background: colors[index] }"></span>
                    <span class="heatmap-rating-popover__meta"><b>{{ index }}</b> · {{ label }}</span>
                </div>

                <div class="heatmap-rating-popover__clear">
                    <button type="button" @click="clear">✕ {{ Locale.getLabel('imet-core::common.clear') }}</button>
                </div>
            </div>
        </Teleport>

        <input type="hidden"
               :id=id
               v-model="inputValue"
        />

    </div>
</template>

<script setup>

import {computed, nextTick, onBeforeUnmount, ref, watch} from "vue";

const Locale = window.ModularForms.Helpers.Locale;

const props = defineProps({
    id: {
        type: String,
        default: null
    },
    // Word label per score, keyed 0→N. Injected from the module ratingLegend.
    // Arrives from Blade as a JSON-encoded string, or as an Array.
    legend: {
        type: [Array, String],
        default: () => null
    },
    // Fill colour per score, index 0→N. Default white→yellow→orange→red→bordeaux.
    colors: {
        type: Array,
        default: () => ['#FFFFFF', '#FFE25A', '#FBA63C', '#E5483B', '#7C1D2E']
    }
});

const inputValue = defineModel();

const open = ref(false);
const highlighted = ref(-1);
const trigger = ref(null);
const popover = ref(null);
const popStyle = ref({});

// The legend may be an Array or a JSON-encoded object keyed by score ("0", "1"…).
const labels = computed(() => {
    let raw = props.legend;
    if (typeof raw === 'string') {
        try {
            raw = JSON.parse(raw);
        } catch {
            raw = null;
        }
    }
    if (raw === null || typeof raw !== 'object') {
        return [];
    }
    if (Array.isArray(raw)) {
        return raw;
    }
    return Object.keys(raw)
        .sort((a, b) => Number(a) - Number(b))
        .map((key) => raw[key]);
});

// The current score as a Number, or null when unset. Stored value may be a string.
const score = computed(() => {
    const value = inputValue.value;
    if (value === null || value === undefined || value === '') {
        return null;
    }
    const parsed = Number(value);
    return Number.isNaN(parsed) ? null : parsed;
});

const isSet = computed(() => score.value !== null);

const cellStyle = computed(() => {
    const style = {};
    if (isSet.value) {
        style.background = props.colors[score.value];
    }
    return style;
});

function toggle() {
    open.value ? close() : openPicker();
}

function openPicker() {
    open.value = true;
    highlighted.value = isSet.value ? score.value : 0;
    nextTick(() => {
        updatePosition();
        popover.value?.focus();
        window.addEventListener('scroll', updatePosition, true);
        window.addEventListener('resize', close);
    });
}

function close() {
    open.value = false;
    window.removeEventListener('scroll', updatePosition, true);
    window.removeEventListener('resize', close);
}

function pick(value) {
    inputValue.value = value;
    close();
    nextTick(() => trigger.value?.focus());
}

function clear() {
    inputValue.value = null;
    close();
    nextTick(() => trigger.value?.focus());
}

// Popover is teleported to <body> so it is never clipped by a table cell overflow.
// Position it with fixed coordinates against the trigger, flipping above if needed.
function updatePosition() {
    const el = trigger.value;
    if (!el) {
        return;
    }
    const rect = el.getBoundingClientRect();
    const pop = popover.value;
    const width = pop ? pop.offsetWidth : 160;
    const height = pop ? pop.offsetHeight : 240;
    let left = rect.left;
    let top = rect.bottom + 6;
    if (left + width > window.innerWidth - 8) {
        left = window.innerWidth - width - 8;
    }
    if (top + height > window.innerHeight - 8) {
        top = rect.top - height - 6;
    }
    if (top < 8) {
        top = 8;
    }
    popStyle.value = {left: `${Math.max(8, left)}px`, top: `${top}px`};
}

function onTriggerKeydown(event) {
    if (['ArrowDown', 'ArrowUp', 'Enter', ' '].includes(event.key) && !open.value) {
        event.preventDefault();
        openPicker();
    }
}

function onPopoverKeydown(event) {
    const last = labels.value.length - 1;
    switch (event.key) {
        case 'ArrowDown':
            event.preventDefault();
            highlighted.value = highlighted.value >= last ? 0 : highlighted.value + 1;
            break;
        case 'ArrowUp':
            event.preventDefault();
            highlighted.value = highlighted.value <= 0 ? last : highlighted.value - 1;
            break;
        case 'Home':
            event.preventDefault();
            highlighted.value = 0;
            break;
        case 'End':
            event.preventDefault();
            highlighted.value = last;
            break;
        case 'Enter':
        case ' ':
            event.preventDefault();
            if (highlighted.value >= 0) {
                pick(highlighted.value);
            }
            break;
        case 'Backspace':
        case 'Delete':
            event.preventDefault();
            clear();
            break;
        case 'Escape':
            event.preventDefault();
            close();
            nextTick(() => trigger.value?.focus());
            break;
        default:
            if (/^[0-9]$/.test(event.key) && Number(event.key) <= last) {
                event.preventDefault();
                pick(Number(event.key));
            }
    }
}

function onDocumentClick(event) {
    if (!open.value) {
        return;
    }
    if (trigger.value?.contains(event.target) || popover.value?.contains(event.target)) {
        return;
    }
    close();
}

watch(open, (isOpen) => {
    if (isOpen) {
        document.addEventListener('click', onDocumentClick, true);
    } else {
        document.removeEventListener('click', onDocumentClick, true);
    }
});

onBeforeUnmount(() => {
    document.removeEventListener('click', onDocumentClick, true);
    window.removeEventListener('scroll', updatePosition, true);
    window.removeEventListener('resize', close);
});

</script>

<style scoped>

@reference "@modular-forms/index.css";

/* ---------- the cell ---------- */
.heatmap-rating-cell {
    width: 100%;
    min-width: 75px;
    height: 28px;
    display: block;
    padding: 0;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: box-shadow 0.12s ease, transform 0.08s ease;
}

.heatmap-rating-cell--empty {
    background: repeating-linear-gradient(
        135deg,
        #efeff2,
        #efeff2 5px,
        #f8f8fa 5px,
        #f8f8fa 10px
    );
    border: 1.4px dashed #c4c6cd;
}

.heatmap-rating-cell--set {
    box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.1);
}

/* value 0 is white — give it a slightly stronger edge so it reads as "set", not empty */
.heatmap-rating-cell--zero {
    box-shadow: inset 0 0 0 1.4px rgba(0, 0, 0, 0.18);
}

.heatmap-rating-cell:hover {
    transform: translateY(-1px);
}

.heatmap-rating-cell--set:hover {
    box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.1),
        0 0 0 3px color-mix(in srgb, oklch(37.3% 0.034 259.733) 22%, transparent);  /* tailwind text-gray-700; */
}

.heatmap-rating-cell:focus-visible {
    outline: 2px solid oklch(37.3% 0.034 259.733);  /* tailwind text-gray-700; */
    outline-offset: 2px;
}

/* ---------- the popover (teleported to body, scoped attr still applies) ---------- */
.heatmap-rating-popover {
    position: fixed;
    z-index: 1000;
    min-width: 152px;
    padding: 6px;
    background: #fff;
    border: 1px solid #d4d6dc;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(40, 42, 48, 0.22);
    font: 14px/1.3 ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto,
        Helvetica, Arial, sans-serif;
}

.heatmap-rating-popover:focus {
    outline: none;
}

.heatmap-rating-popover__row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 5px 7px;
    border-radius: 5px;
    color: #565b65;
    cursor: pointer;
}

.heatmap-rating-popover__row.is-active {
    @apply bg-gray-200;
    color: #2d3036;
}

.heatmap-rating-popover__row.is-selected {
    font-weight: 600;
    background: oklch(0.6 0.118 184.704);   /* bg-primary-700 */
    color: white;
}

.heatmap-rating-popover__chip {
    flex: none;
    width: 42px;
    height: 24px;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.2);
}

.heatmap-rating-popover__meta b {
    font-weight: 700;
}

.heatmap-rating-popover__clear {
    margin-top: 5px;
    padding-top: 5px;
    border-top: 1px solid #ececef;
}

.heatmap-rating-popover__clear button {
    width: 100%;
    padding: 5px 7px;
    font: inherit;
    font-size: 13px;
    text-align: left;
    color: #7b808a;
    background: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.heatmap-rating-popover__clear button:hover {
    background: #f0f1f4;
    color: #2d3036;
}

</style>
